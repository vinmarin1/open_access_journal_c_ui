// Function to generate a random string (salt)
function generateRandomString(length) {
    const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    let randomString = '';
    for (let i = 0; i < length; i++) {
      randomString += characters.charAt(Math.floor(Math.random() * characters.length));
    }
    return randomString;
  }
  
  // Generate a random salt
  const salt = generateRandomString(10);
  
  // Generate a random secret number (positive integer)
  const secretNumber = Math.floor(Math.random() * Number.MAX_SAFE_INTEGER);
  
  // Concatenate salt and secret number
  const challengeString = salt + secretNumber;
  
  // Compute the SHA256 hash of the concatenated string (result encoded as HEX string)
  async function generateSHA256Hash(message) {
    const encoder = new TextEncoder();
    const data = encoder.encode(message);
    const hashBuffer = await crypto.subtle.digest('SHA-256', data);
    const hashArray = Array.from(new Uint8Array(hashBuffer));
    const hashHex = hashArray.map(byte => byte.toString(16).padStart(2, '0')).join('');
    return hashHex;
  }
  
  // Create a server signature using HMAC-SHA256 (result encoded as HEX string)
  async function generateHMACSHA256Signature(message, key) {
    const encoder = new TextEncoder();
    const data = encoder.encode(message);
    const keyData = encoder.encode(key);
    const importedKey = await crypto.subtle.importKey('raw', keyData, { name: 'HMAC', hash: 'SHA-256' }, false, ['sign']);
    const signatureBuffer = await crypto.subtle.sign('HMAC', importedKey, data);
    const signatureArray = Array.from(new Uint8Array(signatureBuffer));
    const signatureHex = signatureArray.map(byte => byte.toString(16).padStart(2, '0')).join('');
    return signatureHex;
  }
  
  (async () => {
    const challenge = await generateSHA256Hash(challengeString);
    const hmac_key = 'your_hmac_key_here';
    const signature = await generateHMACSHA256Signature(challenge, hmac_key);
  
    const response = {
      algorithm: 'SHA-256',
      challenge,
      salt,
      signature,
    };
  
    const jsonResponse = JSON.stringify(response);
    console.log(jsonResponse);
  })();
  