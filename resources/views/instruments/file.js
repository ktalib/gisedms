const express = require("express");
const speakeasy = require("speakeasy");
const qrcode = require("qrcode");
const bodyParser = require("body-parser");

const app = express();
app.use(bodyParser.json());

let users = {}; // Store user data (for demo, use a DB in production)

// Generate 2FA Secret & QR Code
app.post("/generate-2fa", (req, res) => {
    const { username } = req.body;

    const secret = speakeasy.generateSecret({ name: `MyApp (${username})` });
    users[username] = { secret: secret.base32 };

    qrcode.toDataURL(secret.otpauth_url, (err, qrCodeUrl) => {
        if (err) return res.status(500).json({ error: "Error generating QR code" });
        res.json({ secret: secret.base32, qrCodeUrl });
    });
});

// Verify 2FA Code
app.post("/verify-2fa", (req, res) => {
    const { username, token } = req.body;
    const user = users[username];

    if (!user) return res.status(400).json({ error: "User not found" });

    const verified = speakeasy.totp.verify({
        secret: user.secret,
        encoding: "base32",
        token
    });

    res.json({ verified });
});

app.listen(3000, () => console.log("Server running on port 3000"));
