INSERT MANDATORY GIF

# Project Title

This is a to-do list application .
A school project written in HTML, CSS, JavaScript, SQL and PHP.

+ As a user I'm able to create an account.

+ As a user I'm able to login.

+ As a user I'm able to logout.

+ As a user I'm able to edit my account email and password.

+ As a user I'm able to upload a profile avatar image.

+ As a user I'm able to create new tasks with title, description and deadline date.

+ As a user I'm able to edit my tasks.

+ As a user I'm able to delete my tasks.

+ As a user I'm able to mark tasks as completed.

+ As a user I'm able to mark tasks as uncompleted.

+ As a user I'm able to create new task lists with title.

+ As a user I'm able to edit my task lists.

+ As a user I'm able to delete my task lists along with all tasks.

+ As a user I'm able to add a task to a list.

+ As a user I'm able to view all tasks.

+ As a user I'm able to view all tasks within a list.

+ As a user I'm able to view all tasks which should be completed today.

+ Extra: As a user I'm able to delete my account along with all tasks and lists.



# Installation

+ Clone repo via the terminal or GitHub desktop.
+ Run the application in localhost.

# Code Review

Code review written by [Hanna Rosenberg](https://github.com/hanna-rosenberg).

1. `register.php:9-10`- Make sure you filter/sanitize the input from the user.
2. `config.php:6` - Change "titel" to "title", otherwise the title of your site won't show in the browser-bar!
3. `profile.php` - When updating profile, the user has to change both email and password to continue. Maybe use separate forms to avoid this. 
4. `update2.php` - When changing email and password and pressing "Update profile" you are redirected to update2.php and a long error-message is shown.
5. `tasks.php` - When the user tries to add a task with deadline today, an error-message with the text "The date has already past, choose a later date".
6. `tasks.php` - I can't complete or uncomplete the tasks, an error message is shown when pressing the ticks and the database doest seeem to register.
7. `tasks.php` - When trying to edit a task, the user needs to fill in all forms. I would recommend that you use different forms instead!
8. `tasks.php:86` - When saving the changes an error-message is shown under the title of the task.
9. `general` - The code would be easier to follow with more comments.
10. `general` - It's not possible to view all tasks with deadline today.
11. `README.md`- Update your README-file with instructions etc.

# Testers

Tested by the following people:

1. Jane Doe
2. John Doe
