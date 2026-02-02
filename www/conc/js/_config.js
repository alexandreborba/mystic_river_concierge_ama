;(function(window){
  const { origin, pathname } = window.location;

  // Extrai o primeiro segmento do path
  // Ex: /mrc/home → ["", "mrc", "home"]
  const pathParts = pathname.split('/').filter(Boolean);

  // Se existir, usa como container, senão fallback
  const container = pathParts.length > 0 ? pathParts[0] : 'mrc';

  window.APP_CONFIG = {
    shipCode:  'AMA',
    server:    origin,
    container: container
  };

  // Debug opcional
  console.log('[APP_CONFIG]', window.APP_CONFIG);
})(window);