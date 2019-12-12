#include <iostream>
#include <string>
#include <time.h>
#include <limits>

using namespace std;

string expandString(string str, int length) 
{
  if (length <= str.size()) 
  {
      return str.substr(0, length);
  }
  
  while (str.size() * 2 <= length) 
  {
    str += str;
  }
  if (str.size() < length) 
  {
    str += str.substr(0, length - str.size());
  }
  return str;
}

uint8_t next_value(uint8_t salt)
{
    salt ^= 170;
    
    uint8_t highest = (salt & 192) / 64;
    salt <<= 2;
    salt += highest;
    
    return (salt * 53 + 71) % 256;
}

int main()
{
    srand(time(NULL)); //random seed
    
    const string characters ("0123456789ABCDEF");
    
    cout << "PASSWORD TO ENCRYPT: ";
    string password;
    cin >> password;
    
    password = char(254) + password + char(255);
    password = expandString(password, 20);

    string encryptedPassword = "";
    
    uint8_t salt = rand() % 256;
    cout << '\n' << "USED SALT: " << int(salt) << '\n';
    uint8_t value = next_value(salt);

    for (uint8_t i = 0; i < 20; i++)
    {
        uint8_t xored = value ^ uint8_t(password[i]);
        encryptedPassword += characters[xored >> 4]; //take top 4 bits
        encryptedPassword += characters[xored & 15]; //take bottom 4 bits
        
        salt = (salt + 1) % 256;
        value = next_value(salt);
    }
    
    cout << '\n' << encryptedPassword << '\n';
    
    cout << '\n' << "PRESS ENTER TO QUIT...";
    cin.clear();
    cin.ignore(numeric_limits<streamsize>::max(), '\n');
    cin.get();
 
    return 0;
}