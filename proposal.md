# Major Project Proposal

## Description
My major project is going to be a Capture the Flag (CTF) Hacking Competition. Hopefully taking place 1-3weeks before finals.
It consists of the repositories CTF, CTF_AI_BATTLE, and CTF_ENCRYPTOR_DECRYPTOR.
The CTF would take 1.5 - 3 hours, with many challenges and possibly an AI battle instead of a Prog catagory
Teams should consist of 2-4 (5 and 1 may be allowed but not encouraged), even unexperienced people should be able to complete
some of the challenges and only the best should be able to do the most complicated. 

## Need To Have List
 - 4 Catagories of challenges Crypto, Forensics (A weird mixuture of actual forensics, recon, exploitation, and web), Reverse, Prog
 - At least 4 challenges per catagory. These challenges will increase in difficulty from the first few being anybody can do them. Then the last being you need to be pretty skilled to complete it. I am aiming so that everyone will finish the first few, 50% of people will finish the ones in the middle, and only one or two teams will finish the last (for each catagory).
 - An SQL database to keep track of players, teams, and challenges completed.
 - A website to access the various challenges.
 - Ability to navigate to the various challenges and catagories of challenges.
 - Descriptions of what each catagory is.
 - Login and Register portions of the site.
 - Scoreboard on the side of the website.
 - Being able to view how many and which challenges other teams have completed.
 - Unhackable Admin page for use by me during the CTF.
 - Having the challenges be sercure so you cannot get the flag without doing the challenges (using prepared statements and whatnot).
 
### Challenge Ideas:
 - Crypto:
   - One challenge about caesar cipher.
   - One about a message encoded using a different base number system.
   - One about stegenography
   - One about a number encoded using math between different rgb values.
 - Forensics:
   - One challenge about looking through the code of a JS game to use a cheat code.
   - One about a corrupted jpgs that you need to open with note pad.
   - One about QR codes hidden in some pictures.
   - One about an SQL injection.
 - Reverse:
   - One simple challenge about reversing python.
   - One slightly more complicated challenge about reversing JS.
   - One about writing a program to brute force an encrypted password generated in C++.
   - One about reversing obfuscated JS.
 
## Nice To Have List
 - Instead of a Prog catagory do an AI competition.
   - The AI competitions will consist of every team submiting a Bot/AI. 
   Those Bots would fight every 15ish minutes, the winner and runners up would be awarded points.
   - The competition would also have generate a fair and equal map, that would would be fair for every player.
   - The competition will most likely be something like: every player starts with 2 bases and some units, units can step on resources to
   create more units, running into or attacking enemy units will hurt/kill them, steping on an enemy base will destroy it. Last team
   standing wins.
   - The participants would also be provided a copy of the program used to run the AI Battle so they can test their creations.
   - The participants would also be given a few default bots, for example they are given two: one that poorly attacks and nothing else, one that poorly collects resources and nothing else. The first expected move of the participants would be to stitch the two together (should take until the first match to understand the game and do this) then improve the bots.
   - On the website there would also extensive documentation for the API given to the participants.
 - 5 challenges per catagory (The ones added would probably be on the easy side).
 - Timers on the site for when the CTF starts and when an AI Battle will start.
 - Sexy looking website for the CTF.
