# Written by: Your Friend ;)

def alter(word_codes):
    code_change = [2,3,2,1,4,5,4,3,8,1]
    new_code = ''
    for i in range(10):
        new_code += chr(ord(word_codes[i]) + code_change[i])
    return new_code


location = input('Where will we meet tonight?\n')
if len(location) != 10:
    print('Wrong buddy...')
elif alter(alter(location)) == 'wneykovzut':
    print('Correct, we are meeting at the ' + location)
else:
    print('Wrong buddy...')