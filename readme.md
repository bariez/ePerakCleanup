# ePerak

## Installation

Point document root to `public/` directory.

```env
cp .env.example .env
```

## Configuration

On Windows, logs / compiled views need to be in Windows Temporary directory.

To set that, you can configure in `.env` file:

```env
VIEW_COMPILED_PATH="C:\\Windows\\Temp\\eperak\\views\\"
LOG_DAILY_PATH="C:\\Windows\\Temp\\eperak\\logs\\laravel.log"
```

## Deployment

Open up Git Bash, then navigate to project directory:

```bash
cd /c/inetpub/wwwroot/eperakCleanup
```

then get latest codes:

```bash
git pull origin master
```

Any additional steps should be run separately.
