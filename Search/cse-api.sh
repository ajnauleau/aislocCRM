#! /bin/sh

HOST="www.google.com"

EMAIL="$1"
PASSWORD="$2"
USERID="$3"
CSEID="$4"

URL="http://$HOST/cse/api/$USERID/index/$CSEID"
ISPOST=1

AUTHTOKEN='curl -k https://www.google.com/accounts/ClientLogin -d Email=$EMAIL \
 -d Passwd=$PASSWORD -d accountType=GOOGLE -d service=cprose | grep -x "Auth=.*"'
AUTHTOKEN='echo $AUTHTOKEN | cut -d = -f 2'
AUTHHEADER="Authorization: GoogleLogin auth=$AUTHTOKEN"

TMP="post.xml"
echo "" > $TMP

XML="<OnDemandIndex>
<Pages>
 <Page url=\"http://www.d1toine.aisloc.com\">
 </Page>
</Pages>
</OnDemandIndex>"

echo $XML >> $TMP;

echo "Posting to $URL"
echo "Header: $AUTHHEADER"
echo "Content:"
cat $TMP

curl -v -X POST -d @$TMP -H "$AUTHHEADER" -H "Content-Type:text/xml" $URL
