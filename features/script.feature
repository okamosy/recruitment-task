Feature: script
  In order to sum the contents of a file
  As a CLI user
  I need to be able to generate a sum of a files contents

Scenario: Run the script without any parameters
  Given I am in the current directory
  When I run "php script.php"
  Then I should get:
    """
    You must provide at least one parameter
    """