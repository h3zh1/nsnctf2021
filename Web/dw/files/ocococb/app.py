from math import exp
from ocb.aes import AES # https://github.com/kravietz/pyOCB
from base64 import b64encode, b64decode
from Crypto.Util.number import *
from hashlib import sha256
from secret import flag
from ocb import OCB
import socketserver
import signal
import string
import random
import os

xor = lambda s1 , s2 : bytes([x1^x2 for x1,x2 in zip(s1,s2)])
def pad(data):
    padlen = 16 - len(data) % 16
    return data + padlen * bytes([padlen])
def unpad(data):
    return data[:-data[-1]]

BANNER =br'''
 __      __          ___                                           __                                               __       ___  
/\ \  __/\ \        /\_ \                                         /\ \__                                           /\ \__  /'___\ 
\ \ \/\ \ \ \     __\//\ \     ___    ___     ___ ___      __     \ \ ,_\   ___       __  __  __    ___ ___     ___\ \ ,_\/\ \__/ 
 \ \ \ \ \ \ \  /'__`\\ \ \   /'___\ / __`\ /' __` __`\  /'__`\    \ \ \/  / __`\    /\ \/\ \/\ \ /' __` __`\  /'___\ \ \/\ \ ,__\
  \ \ \_/ \_\ \/\  __/ \_\ \_/\ \__//\ \L\ \/\ \/\ \/\ \/\  __/     \ \ \_/\ \L\ \   \ \ \_/ \_/ \/\ \/\ \/\ \/\ \__/\ \ \_\ \ \_/
   \ `\___x___/\ \____\/\____\ \____\ \____/\ \_\ \_\ \_\ \____\     \ \__\ \____/    \ \___x___/'\ \_\ \_\ \_\ \____\\ \__\\ \_\ 
    '\/__//__/  \/____/\/____/\/____/\/___/  \/_/\/_/\/_/\/____/      \/__/\/___/      \/__//__/   \/_/\/_/\/_/\/____/ \/__/ \/_/ 
'''

MENU = br'''[+] 1.Encrypt
[+] 2.Decrypt
[+] 3.Get flag
[+] 4.exit
'''

class Task(socketserver.BaseRequestHandler):
    def _recvall(self):
        BUFF_SIZE = 2048
        data = b''
        while True:
            part = self.request.recv(BUFF_SIZE)
            data += part
            if len(part) < BUFF_SIZE:
                break
        return data.strip()

    def send(self, msg, newline=True):
        try:
            if newline:
                msg += b'\n'
            self.request.sendall(msg)
        except:
            pass

    def recv(self, prompt=b'[-] '):
        self.send(prompt, newline=False)
        return self._recvall()

    def proof_of_work(self):
        random.seed(os.urandom(8))
        proof = ''.join([random.choice(string.ascii_letters+string.digits) for _ in range(20)])
        _hexdigest = sha256(proof.encode()).hexdigest()
        self.send(f"[+] sha256(XXXX+{proof[4:]}) == {_hexdigest}".encode())
        x = self.recv(prompt=b'[+] Plz tell me XXXX: ')
        if len(x) != 4 or sha256(x+proof[4:].encode()).hexdigest() != _hexdigest:
            return False
        return True

    def encrypt(self, nonce, message, associate_data=b''):
        self.ocb.setNonce(nonce)
        message = pad(message)
        print(message)
        tag, cipher = self.ocb.encrypt(bytearray(message), bytearray(associate_data))
        return (bytes(cipher), bytes(tag))
    
    def decrypt(self, nonce, cipher, tag, associate_data=b''):
        self.ocb.setNonce(nonce)
        authenticated, message = self.ocb.decrypt(*map(bytearray, (associate_data, cipher, tag)))
        message = unpad(message)
        if not authenticated:
            self.send(b"[!] Who are you???")
            return b''
        return bytes(message[-1])

    def handle(self):
        signal.alarm(60)
        self.send(BANNER)
        if not self.proof_of_work():
            self.send(b'[!] Wrong!')
            return
        
        self.send(b'[+] Welcome my friend!')
        self.send(b'[+] Can you find the secret through the encryption system?')

        aes = AES(128)
        self.ocb = OCB(aes)
        KEY = os.urandom(16)
        self.ocb.setKey(KEY)
        self.opportunity = 3
        self.secret = os.urandom(16)
        print(self.secret)

        while True:
            self.send(MENU, newline=False)
            choice = self.recv()
            if(choice == b'1'):
                if self.opportunity == 0:
                    self.send(b'[!] Sorry, the encryption was used too many times and it broke!')
                else:
                    self.opportunity -= 1
                    try:
                        self.send(b'[+] Please input your nonce')
                        nonce = b64decode(self.recv())
                        self.send(b'[+] Please input your message')
                        message = b64decode(self.recv())
                        if self.opportunity == 0:
                            self.send(b"[*] Thanks for using my encryption system!")
                            self.send(b"[*] I will give you my secret as a gift!")
                            message += self.secret
                        associate_data = b'from baby'
                        ciphertext, tag = self.encrypt(nonce, message, associate_data)
                        self.send(b"[+] ciphertext: " + b64encode(ciphertext))
                        self.send(b"[+] tag: " + b64encode(tag))
                    except:
                        self.send(b"[!] ERROR!")
            elif(choice == b'2'):
                try:
                    self.send(b'[+] Please input your nonce')
                    nonce = b64decode(self.recv())
                    self.send(b'[+] Please input your ciphertext')
                    ciphertext = b64decode(self.recv())
                    self.send(b'[+] Please input your tag')
                    tag = b64decode(self.recv())
                    associate_data = b'From admin'
                    message = self.decrypt(nonce, ciphertext, tag, associate_data)
                    self.send(b'[+] plaintext: ' + b64encode(message))
                except:
                    self.send(b"[!] ERROR!")
            elif(choice == b'3'):
                self.send(b'[+] Plz give me the secret to prove you are admin!')
                guess = self.recv().strip()
                if guess == self.secret:
                    self.send(b'[!] Here is your flag:' + flag)
                else:
                    self.send(b'[!] Hey! You are not admin!')
                    self.send(b'[!] Go away!')
                    break
            elif(choice == b'4'):
                self.send(b'[+] Bye~')
                self.send(b'[+] See you next time!')
                break
            else:
                self.send(b'[!] What are you doing???')
                self.send(b'[!] Go away!')
                break

        self.request.close()

class ThreadedServer(socketserver.ThreadingMixIn, socketserver.TCPServer):
    pass

class ForkedServer(socketserver.ForkingMixIn, socketserver.TCPServer):
    pass

if __name__ == "__main__":
    HOST, PORT = '0.0.0.0', 10001
    server = ForkedServer((HOST, PORT), Task)
    server.allow_reuse_address = True
    print(HOST, PORT)
    server.serve_forever()
