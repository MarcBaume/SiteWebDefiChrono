/srv/customer/sites/app.defichrono.ch/package.json

const express = require("express");

const app = express();
const port = process.env.PORT || 3000;

app.get("/", (req, res) => {
  res.send(`
    <!doctype html>
    <html lang="fr">
      <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Test Defichrono</title>
      </head>
      <body style="font-family: sans-serif; max-width: 600px; margin: 60px auto; padding: 20px;">
        <h1>Defichrono</h1>
        <p>Le site de test Node.js fonctionne.</p>
        <a href="/login">Se connecter avec Keycloak</a>
      </body>
    </html>
  `);
});

app.get("/login", (req, res) => {
  const url = new URL(
    "https://auth.defichrono.ch/realms/loginDefiChrono/protocol/openid-connect/auth"
  );

  url.searchParams.set("client_id", "defichrono-auth");
  url.searchParams.set("response_type", "code");
  url.searchParams.set("scope", "openid");
  url.searchParams.set("redirect_uri", "https://app.defichrono.ch/callback");

  res.redirect(url.toString());
});

app.get("/callback", (req, res) => {
  res.send(`
    <!doctype html>
    <html lang="fr">
      <head><meta charset="utf-8"><title>Retour Keycloak</title></head>
      <body style="font-family: sans-serif; margin: 60px auto; max-width: 600px;">
        <h1>Retour de Keycloak</h1>
        <p>Keycloak a redirigé le navigateur vers cette page.</p>
        <p>Ce test ne valide pas encore le code d'autorisation ni la session.</p>
        <a href="/">Retour à l'accueil</a>
      </body>
    </html>
  `);
});

app.listen(port, "0.0.0.0", () => {
  console.log(`Defichrono écoute sur le port ${port}`);
});

https://auth.defichrono.ch/realms/defichrono/protocol/openid-connect/auth?client_id=defichrono-auth&response_type=code&scope=openid&redirect_uri=https%3A%2F%2Fapp.defichrono.ch%2Fcallback
https://auth.defichrono.ch/admin/loginDefiChrono/console/