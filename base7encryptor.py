#base 7
import math

def decimal_to_nine(val):
    nines_digit = math.floor(val / 7)
    ones_digit = val % 7
    if (nines_digit == 0):
        return str(ones_digit)
    return str(nines_digit) + str(ones_digit)
    
    
alphabet = ['a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z','-']

password = 'well-done-you-are-now-a-member-of-the-pwn-patrol---welcome-to-the-force-sir'
encrypt = ''

for letter in password:
    encrypt += decimal_to_nine(alphabet.index(letter)) + ', '
    
print(encrypt)