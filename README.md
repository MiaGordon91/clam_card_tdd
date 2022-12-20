# clam_card_tdd

Contactless travel system for subways

User Stories

One-Way Zone 1 Journey
Given Michael has an Clam Card
And Michael travels from Asterisk to Aldgate
Then Michael will be charged $2.50 for his first journey

One-Way Zone 1 to Zone 2 Journey
Given Michael has an Clam Card
And Michael travels from Asterisk to Barbican
Then Michael will be charged $3.00 for his first journey

Multiple journeys
Given Michael has an Clam Card
And Michael travels from Asterisk to Aldgate
And Michael travels from Asterisk to Balham
Then Michael will be charged $2.50 for his first journey
And a further $3.00 for his second journey



To run the test class/folder please copy and paste the following and replace the placeholder with the test name

'php vendor/bin/phpunit tests/ClamCardTest.php' 

Alternatively, if you would like to run individual tests please type the following

'php vendor/bin/phpunit tests/ClamCardTest.php --filter [testName]'


Notes

Set construct method on the initial balance of clam card