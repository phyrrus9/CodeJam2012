//
//  main.cpp
//  googlerese
//
//  Created by Ethan Laur on 4/13/12.
//  Copyright (c) 2012 <phyrrus9@gmail.com>
//
#define a(b) gog[search(b,orig)]
#include <iostream>
#include <cstring>
#include <fstream>
#include <string>
#include <sstream>
using namespace std;
int search(char c,char orig[])
{
    for (int i = 0; i < 27; i++)
        if (orig[i] == c)
            return i;
}
int main(int argc, const char * argv[])
{
    if (argc < 2)
    {
        cout << "ERR no input" << endl;
        return -1;
    }
    std::ifstream file(argv[1]);
    int runs = -1;
    char s[100];
    file >> runs;
    if (runs > 30 || runs < 0)
        cout << "err" << endl;//exit(-1); //you broke the rules
    string rmtmp;
    getline(file,rmtmp); //for some reason line 2 is read blank ... this fixes it
    for (int cn = 0; cn < runs; cn++)
    {
        cout << "Case #" << cn+1 << ": ";
        string line;
        getline(file,line);
        strcpy(s,line.c_str());
        //std::cout << line << std::endl;
        //cout << s << endl;
        char orig[27] = {'a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z',' '};
        char  gog[27] = {'y','h','e','s','o','c','v','x','d','u','i','g','l','b','k','r','z','t','n','w','j','p','f','m','a','q',' '};
        for (int i = 0; i < strlen(s); i++)
        {
            if (isspace(s[i]))
                std::cout << " ";
            else if (isalpha(s[i]))
                std::cout << a(tolower(s[i])); //just in case you slipped
        }
        cout << endl;
    }
    //std::cout << search_("ejp",orig)<<  std::endl;
    return 0;
}

