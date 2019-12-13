# Written by: Your Friend ;)

def alter(word_codes):
    code_change = [2,3,2,1,4,5,4,3,8,1]
    new_code = ''
    for i in range(10):
        #changes the original word by ADDING the value of code_change[i] to each letter
        new_code += chr(ord(word_codes[i]) + code_change[i])
    return new_code

location = input('Where will we meet tonight?\n')
if len(location) != 10:
    # only bothers with 10 letter long entries
    print('Wrong buddy...')
elif alter(alter(location)) == 'wneykovzut':
    # remember there are 2 alters
    print('Correct, we are meeting at the ' + location)
else:
    print('Wrong buddy...')
