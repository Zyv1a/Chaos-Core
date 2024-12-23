const express = require('express');
const axios = require('axios');
const app = express();
const port = 3000;

// Exemple de fonction pour récupérer les badges du joueur
async function getPlayerBadges(playerId) {
    try {
        // Remplacer par l'URL de l'API de Roblox pour récupérer les badges
        const response = await axios.get(`https://api.roblox.com/users/${playerId}/badges`);
        
        // Simuler un tableau d'achievements obtenus
        // Ce tableau doit être modifié en fonction des badges récupérés via Roblox
        const badges = response.data;
        
        // Retourner un tableau de badges avec un ID pour chaque achievement
        return {
            firstKill: badges.includes(12345), // Exemple d'ID de badge pour 'First Kill'
            teamPlayer: badges.includes(67890), // ID pour 'Team Player'
            flagCapturer: badges.includes(11223), // ID pour 'Flag Capturer'
            dominantForce: badges.includes(44556), // ID pour 'Dominant Force'
            kingOfTheHill: badges.includes(78901), // ID pour 'King of the Hill'
            freeForAllChampion: badges.includes(23456) // ID pour 'Free-for-All Champion'
        };
    } catch (error) {
        console.error('Erreur de récupération des badges:', error);
        return {}; // Retourner un objet vide en cas d'erreur
    }
}

// Route pour récupérer les achievements du joueur
app.get('/achievements', async (req, res) => {
    const playerId = req.query.playerId; // ID du joueur passé comme paramètre dans l'URL
    if (!playerId) {
        return res.status(400).json({ error: 'Player ID is required' });
    }

    const playerBadges = await getPlayerBadges(playerId);
    res.json(playerBadges);
});

// Serve static files (HTML, CSS, JS)
app.use(express.static('public'));

// Démarrer le serveur
app.listen(port, () => {
    console.log(`Server running at http://localhost:${port}`);
});
