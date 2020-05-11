##We want to build a project in Laravel 7 which a user from any place in the world can book appointments from different experts by choosing a date and time.


 
### some noitce
#### 1- in Database all Times will be saved in GMT .
#### 2- for user : this project sit will send time in GMT to user browser . but befor user show this time: js function will convert it on fly to Time in user local host timezone(I make many js functions to make this convertion)
#### 3-when experts  register : he/she enter working hour as in her/his timezone... put in database will be converted to GMT and then will be saved.
#### 4- slots generated automaticlly from working hours of Expert
#### 5- to help  users to choose an appointment to start from: The beginning of the appointment has been made so that it begins every quarter of an hour along the working hours

#### 6- if slots in same day will be disabled(user can show it but you can not select it)
#### 7-if user select duration 1Hour: and there is a slot for example in 8 o'clock in same day that is already booked up from another user, then the user will not be able to book slot in  8 o'clock  and the user could not book any slots befor an hour before 8 o'clock  slot, so user will see 5 slots disabled: 7 , 7.15, 7 .30, 7.45  and 8


#### 8-PS. 12 AM is midnight 
#### 9-PS. 12 PM is midday 

#### 10-I use MailTrap for expert registeration and for user confiming of his booking 
#### 11-there is testing DB file :booking_from_expert.sql
