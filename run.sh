#!/bin/bash

if [ $# -lt 2 ]; then
    echo "Usage: ./run.sh <group_ID> <output>" >&2
    exit 1
fi

# Define the main variables
scriptPath="./src/index.php"
groupID=$1
output=$2

# Check if the script exists
if [ ! -f "$scriptPath" ]; then
    echo "The script '$scriptPath' does not exist." >&2
    exit 1
fi

# Execute the PHP script
if php "$scriptPath" "$groupID" "$output"; then
    echo "GroupDownloader's execution ended."
else
    echo "An error occurred while executing GroupDownloader." >&2
    exit 1
fi