from base64 import *
from Crypto.Util.number import *
from gmpy2 import *
from pwn import *
import math
import os

def times2(input_data,blocksize = 16):
    assert len(input_data) == blocksize
    output =  bytearray(blocksize)
    carry = input_data[0] >> 7
    for i in range(len(input_data) - 1):
        output[i] = ((input_data[i] << 1) | (input_data[i + 1] >> 7)) % 256
    output[-1] = ((input_data[-1] << 1) ^ (carry * 0x87)) % 256
    assert len(output) == blocksize
    return output

def times3(input_data):
    assert len(input_data) == 16
    output = times2(input_data)
    output = xor_block(output, input_data)
    assert len(output) == 16
    return output

def back_times2(output_data,blocksize = 16):
    assert len(output_data) == blocksize
    input_data =  bytearray(blocksize)
    carry = output_data[-1] & 1
    for i in range(len(output_data) - 1,0,-1):
        input_data[i] = (output_data[i] >> 1) | ((output_data[i-1] % 2) << 7)
    input_data[0] = (carry << 7) | (output_data[0] >> 1)
    if(carry):
        input_data[-1] = ((output_data[-1] ^ (carry * 0x87)) >> 1) | ((output_data[-2] % 2) << 7)
    assert len(input_data) == blocksize
    return input_data

def xor_block(input1, input2):
    assert len(input1) == len(input2)
    output = bytearray()
    for i in range(len(input1)):
        output.append(input1[i] ^ input2[i])
    return output

def hex_to_bytes(input):
    return bytearray(long_to_bytes(int(input,16)))

def my_pmac(header, offset, blocksize = 16):
    assert len(header)
    header = bytearray(header)
    m = int(max(1, math.ceil(len(header) / float(blocksize))))
    # offset = Arbitrary_encrypt(bytearray([0] * blocksize))
    offset = times3(offset)
    offset = times3(offset)
    checksum = bytearray(blocksize)
    offset = times2(offset)
    H_m = header[((m - 1) * blocksize):]
    assert len(H_m) <= blocksize
    if len(H_m) == blocksize:
        offset = times3(offset)
        checksum = xor_block(checksum, H_m)
    else:
        H_m.append(int('10000000', 2))
        while len(H_m) < blocksize:
            H_m.append(0)
        assert len(H_m) == blocksize
        checksum = xor_block(checksum, H_m)
        offset = times3(offset)
        offset = times3(offset)
    final_xor = xor_block(offset, checksum)
    # auth = Arbitrary_encrypt(final_xor)
    # return auth
    return final_xor

r=remote("127.0.0.1","10001")

def talk1(nonce, message):
    r.recvuntil("[-] ")
    r.sendline("1")
    r.recvuntil("[-] ")
    r.sendline(b64encode(nonce))
    r.recvuntil("[-] ")
    r.sendline(b64encode(message))
    r.recvuntil("ciphertext: ")
    ciphertext = b64decode(r.recvline(False).strip())
    r.recvuntil("tag: ")
    tag = b64decode(r.recvline(False).strip())
    return ciphertext, tag

# context(log_level='debug')

finalnonce = b'\x00'*16
m1 = b"\x00"*15 + b"\x80"
m2 = b"\x10"*16
cipher1, finaltag = talk1(finalnonce,b'')
cipher1 = xor_block(m2,cipher1)
cipher2, finaltag = talk1(finalnonce,m1)
E1 = back_times2(xor_block(cipher1,cipher2[:16]))
assert back_times2(times2(E1))
# E1 = E(finalnonce)
print(E1)

xor1 = my_pmac(b"From admin",E1)
xor2 = my_pmac(b"From user",E1)
m1 = xor_block(xor1,times2(E1))
m2 = xor_block(xor2,times2(times2(E1)))
# context(log_level='debug')
r.interactive()