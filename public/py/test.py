#!/usr/bin/python3
import subprocess

command = 'sudo arp -a'
result = subprocess.Popen(command, stdout=subprocess.PIPE, shell=True)
output = subprocess.Popen(["sudo", "arp", "-a", '>>', 'test.txt'], stdout=subprocess.PIPE).communicate()[0]

#test = result.split(b'\n')
print(output)
