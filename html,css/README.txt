The program consist of few errors .


1. Login session - We were experiencing difficulty when it came on to starting sessions and closing them. We inserted session_start() and ended it after but no success. We them tried implementing tokens but it lead to an error.


2.Password Hashng - Upon hashing the password we noticed an error in testing when logging in with the recently created users compared to the admin user who was input in the sql file. We saw a difference in hashing and assume that the hashing was the problem . This was recognized moments before submission and could not have been fixed in time.


3. Detail linking - We applied multiple theories to this requirment but was not succesful . One of which was applying an id to the <p> tage in which an hidden id was made , collect the text using dom.getElementById and converting it to text. This method was unsuccesful.

4. Logout- The logout was due to the session method mentionedearlier not being able to work.

