const express = require('express');
const axios = require('axios');
const dotenv = require('dotenv');
const app = express();
const port = 3000;

// Charger les variables d'environnement
dotenv.config();

// Variables pour l'authentification Roblox
const CLIENT_ID = process.env.CLIENT_ID;
const CLIENT_SECRET = process.env.CLIENT_SECRET;
const REDIRECT_URI = 'http://localhost:3000/callback';
const ROBLOX_API_URL = 'https://api.roblox.com';

// Middleware pour parser les données POST
app.use(express.json());
app.use(express.urlencoded({ extended: true }));

// Route pour démarrer l'authentification avec Roblox
app.get('/login', (req, res) => {
    const authUrl = `https://apis.roblox.com/oauth2/authorize?client_id=${CLIENT_ID}&redirect_uri=${REDIRECT_URI}&response_type=code&scope=openid`;
    res.redirect(authUrl);
});

// Route de callback après l'authentification avec Roblox
app.get('/callback', async (req, res) => {
    const code = req.query.code;
    
    // Echange du code contre un token d'accès
    try {
        const response = await axios.post('https://apis.roblox.com/oauth2/token', null, {
            params: {
                client_id: CLIENT_ID,
                client_secret: CLIENT_SECRET,
                code,
                redirect_uri: REDIRECT_URI,
                grant_type: 'authorization_code',
            },
        });

        const accessToken = response.data.access_token;
        const userInfo = await getUserInfo(accessToken);
        const badges = await getUserBadges(userInfo.id);

        res.json({
            userInfo,
            badges,
        });

    } catch (error) {
        console.error('Error during OAuth flow:', error);
        res.status(500).send('Internal Server Error');
    }
});

// Fonction pour récupérer les informations utilisateur
async function getUserInfo(accessToken) {
    const response = await axios.get('https://apis.roblox.com/v1/users/self', {
        headers: {
            Authorization: `Bearer ${accessToken}`,
        },
    });
    return response.data;
}

// Fonction pour récupérer les badges de l'utilisateur
async function getUserBadges(userId) {
    const response = await axios.get(`https://users.roblox.com/v1/users/${userId}/badges`);
    return response.data.data;
}

app.listen(port, () => {
    console.log(`Server running at http://localhost:${port}`);
});
