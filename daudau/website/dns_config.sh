#!/usr/bin/env bash
domain="$1"                       # your domain
type="A"                                    # Record type A, CNAME, MX, etc.
name="$2"                                  # name of record to update
ttl=3600                                  # Time to Live min value 600
port="1"                                    # Required port, Min value 1
weight="1"                                  # Required weight, Min value 1
key="dLicfHJCuTTu_2gB2ABkgt7LmerS1Gwefmr"   # key for godaddy developer API
secret="2gBC7QAuSAoVPuDzsenXoE"             # secret for godaddy developer API

headers="Authorization: sso-key $key:$secret"
ip="$3"
curl -X PUT "https://api.godaddy.com/v1/domains/$domain/records/$type/$name" \
-H "accept: application/json" \
-H "Content-Type: application/json" \
-H "$headers" \
-d "[ { \"data\": \"$ip\", \"name\": \"$name\", \"port\": $port, \"priority\": 0, \"protocol\": \"string\", \"service\": \"string\", \"ttl\": $ttl, \"weight\": 0 }]"

