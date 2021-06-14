#! /bin/ksh
#! @brief    BRIEF_DESCRIPTION_HERE
#! @revision 2021-05-31 (Mon) 12:14:43

curl -SsL --request POST --url http://localhost/sandbox/sam/mobile/tmp/rest-2/docs/api/index.php/post \
--header 'content-type: application/json' \
--data '{
    "title": "My third title",
    "body": "Hello world (bis repetita).... I guess!",
    "author": "My name is me!",
    "avatar-id": "4244d90ca0170939115d97c52a1fa604"
}' | jq .

# __END__
