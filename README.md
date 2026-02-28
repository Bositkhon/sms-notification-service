# SMS Gateway API Service
## Local development setup
1. Copy .env.example to .env in your root directory
2. Start docker compose by running `docker compose up -d`
3. Open in browser http://localhost
4. There you have it!

## API endpoint to send a message
1. `/api/sms/send` - Batch send message to phone numbers
```http
POST http://localhost/api/sms/send
Authorization: <Project API KEY>
Content-Type: application/json

{
    "to": ["+998971234567", "+99823456789"],
    "message": "Lorem ipsum"
}
```

