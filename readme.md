![ssc1.png](https://bitbucket.org/repo/9p89LRy/images/692009344-ssc1.png)
![ssc2.png](https://bitbucket.org/repo/9p89LRy/images/3085591602-ssc2.png)

# Your STI Voting System Module #

STI Voting System is a module of the upcoming **STI Student Portal**, a Student Management and Information System. This system is only intended for **STI Supreme Student Council Elections**

## Scope and Features ##

1. This application offers one-time voting. Once the key is used to vote, the system will prohibit the access of the voting page.

2. This application encrypts the voting records to avoid direct data manipulation.

3. Real-time voting results. 

4. Printing of Results and Voting Passes.

5. User and Candidate Management

## Limitations ##

1. As per release, this application limited to create an Administrator Account only. Since the Student Portal is upcoming, it is required to have this feature.

2. This application is limited only to create Candidates, and Partylist. Other data such as year, course are manually inserted in the database. 

3. This application is only limited to generate a maximum of 5,000 vote keys, or voting passes. If you wish to maximize it, feel free to reconfigure the script. 

4. This application is only limited to vote one candidate per position. Multiple selection is not yet supported.

## Server Requirements ##

PHP version 5.6 or newer is recommended.
It should work on 5.3.7 as well, but we strongly advise you NOT to run
such old versions of PHP, because of potential security and performance
issues, as well as missing features.

> I didn't really write those things. Uhmm. I copied that from the default Codeigniter's README. lol.

## Installation Notes ##

1. Extract the package to your `htdocs` or `www` directory (U NO SAY?). You can put this in another sub-directory. By default, this should be placed under `/sti_voting/`, but if you wish to change it, reconfigure the `.htaccess`

2. Create and Import the database. Database is included in `/database/sti_voting.sql`

3. By default, the database is named `sti_voting`, if you wish to change it, reconfigure the database configuration file in `/application/config/database.php`. I bet you are intelligent enough what to change there.

4. To access the Administrator Panel, go to `http://localhost/voting_directory/sys/`. Use the default username: `maco` and password: `maco`

5. Shut down your computer and have a beer. YES. THIS IS MANDATORY.

## FAQ ##
1. **Why is this built with Codeigniter?**
    * Yes. This built with *Codeigniter 3.1.4*, because it's fast, loaded with lazy features, and I know this like since 2014. lol. Yes. I. Am. Serious. And do you expect me to learn more just for this project? Hell naaaww. 

2. **Can I use this in our school or in my project?**
    * Yes. You can. I mean. How the hell would I know? You can use everything, the code, whatever. This one is stupidly, and lazily coded though. So yeah. sure. I would be so much happy if you credit me though. I mean. That's one of the ways how to make devs happy (and beer), right? 


## Support ##
 Yes. You can support yourself.

## Credits ##

[MaterializeCSS](http://materializecss.com/)

[Codeigniter](http://codeigniter.com/)

![sti_dipolog_75.png](https://bitbucket.org/repo/9p89LRy/images/892191762-sti_dipolog_75.png) 

![tdp_h75.png](https://bitbucket.org/repo/9p89LRy/images/4249224223-tdp_h75.png)