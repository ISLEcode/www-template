#! /bin/ksh
#! @brief    BRIEF_DESCRIPTION_HERE
#! @revision 2021-05-31 (Mon) 10:55:26

curl --request PUT \
--url http://localhost/sandbox/sam/mobile/tmp/rest-2/docs/api/index.php/post/1 \
--header 'content-type: application/json' \
--data '{
    "title": "My very first title",
    "body": "Hello world (bis repetita).... I guess!",
    "author": "My name is me!",
    "avatar-id": "4244d90ca0170939115d97c52a1fa604"
}'

# __END__

