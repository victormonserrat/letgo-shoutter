Feature: Shout last tweets from user
    In order to see last tweets from an user in uppercase with a final exclamation
    As an application user
    I want to shout the last tweets from this user

    @application @infrastructure
    Scenario: Shouting last tweets from user
        When I shout last 10 tweets from "victormonserrat"
        Then I should see 10 shouted tweets

    @application @infrastructure
    Scenario: Not shouting more than 10 tweets from user
        When I shout last 11 tweets from "victormonserrat"
        Then I should see it is not possible

    @application @infrastructure
    Scenario: Not shouting less than 1 tweet from user
        When I shout last 0 tweets from "victormonserrat"
        Then I should see it is not possible

    @application @infrastructure
    Scenario: Not shouting last tweets from invalid username
        When I shout last 10 tweets from invalid username
        Then I should see it is not found
