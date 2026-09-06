const http = require("http");
const fs = require("fs");
const path = require("path");

const host = '0.0.0.0';
const port = 8001;

const mimeTypes = {
  '.html': 'text/html',
  '.css': 'text/css',
  '.js': 'application/javascript',
  '.json': 'application/json',
  '.png': 'image/png',
  '.jpg': 'image/jpeg',
  '.jpeg': 'image/jpeg',
  '.gif': 'image/gif',
  '.svg': 'image/svg+xml',
  '.ico': 'image/x-icon',
  '.pdf': 'application/pdf'
};

const publicDir = path.resolve(__dirname, 'public');

const requestListener = (req, res) => {
  // Normalise le chemin de la requête
  let reqPath = req.url === '/' ? '/index.html' : req.url;
  
  // Supprimer la chaîne de requête - ?id=123 ne devrait pas affecter le chemin du fichier
  reqPath = reqPath.split('?')[0];
  
  // Résoudre le chemin et vérifier qu'il reste dans publicDir
  // Le préfixe '.' empêche les chemins absolus d'être résolus incorrectement
  const safePath = path.resolve(publicDir, '.' + reqPath);
  
  // Vérification de sécurité critique : assurez-vous que le chemin résolu se trouve dans publicDir
  if (!safePath.startsWith(publicDir)) {
    res.writeHead(403, { 'X-Content-Type-Options': 'nosniff' });
    res.end('Forbidden');
    return;
  }
  
  // Vérifie si le fichier existe et est bien un fichier (pas un dossier)
  fs.stat(safePath, (err, stat) => {
    if (err || !stat.isFile()) {
      res.writeHead(404, { 'X-Content-Type-Options': 'nosniff' });
      res.end('File not found');
      return;
    }
    
    // Déterminer le type MIME à partir de l'extension de fichier
    const ext = path.extname(safePath).toLowerCase();
    const contentType = mimeTypes[ext] || 'application/octet-stream';
    
    res.setHeader("Content-Type", contentType);
    res.setHeader("X-Content-Type-Options", "nosniff"); // Prevents MIME sniffing attacks
    res.writeHead(200);
    
    // Diffuser le fichier au lieu de le charger en mémoire
    // Essentiel pour les gros fichiers - ne consommera pas toute la mémoire
    const stream = fs.createReadStream(safePath);
    stream.pipe(res);
    
    stream.on('error', () => {
      // Le fichier pourrait être supprimé entre stat() et createReadStream()
      res.writeHead(500, { 'X-Content-Type-Options': 'nosniff' });
      res.end('Server error');
    });
  });
};

const server = http.createServer(requestListener);
server.listen(port, host, () => {
  console.log(`Server is running on http://${host}:${port}`);
  console.log(`Serving static files from: ${publicDir}`);
});
