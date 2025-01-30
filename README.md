# GroupDownloader

**GroupDownloader** is a simple tool to fetch user and post data from a Roblox group and export it to a JSON file.

## Features

- Fetches member list from a specified Roblox group.
- Retrieves posts from the group's wall.
- Saves the data as a JSON file.

## Requirements

- PHP (CLI)
- Bash (for running `run.sh`)
- Internet access

## Installation

1. Clone this repository:
   ```sh
   git clone <repository-url>
   cd GroupDownloader
   ```
2. Ensure PHP is installed and accessible via the command line.

## Usage

Run the script with the following command:
```sh
./run.sh <group_ID> <output>
```
Where:
- `<group_ID>` is the ID of the Roblox group.
- `<output>` is the file path where the JSON result will be saved.

### Example

```sh
./run.sh 123456 output.json
```
This command fetches data from the Roblox group with ID `123456` and saves it to `output.json`.

## License

This project is licensed under the MIT License. See `LICENSE` for details.
