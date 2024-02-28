// Function to validate if two strings are equal
function equals(str1, str2) {
    return str1 === str2;
  }
  
  // Function to compute the SHA256 hash of the concatenated string
  function sha256(str) {
    return crypto.subtle.digest("SHA-256", new TextEncoder().encode(str)).then(buffer => {
      return Array.prototype.map.call(new Uint8Array(buffer), x => ('00' + x.toString(16)).slice(-2)).join('');
    });
  }
  
  // Function to compute the HMAC-SHA256 signature
  async function hmacSHA256(message, key) {
    const encoder = new TextEncoder();
    const data = encoder.encode(message);
    const importedKey = await crypto.subtle.importKey('raw', encoder.encode(key), { name: 'HMAC', hash: 'SHA-256' }, false, ['sign']);
    const signatureBuffer = await crypto.subtle.sign('HMAC', importedKey, data);
    const signatureArray = Array.from(new Uint8Array(signatureBuffer));
    return signatureArray.map(byte => byte.toString(16).padStart(2, '0')).join('');
  }
  
  // Function to validate the payload
  async function validatePayload(payload, hmac_key) {
    try {
      // Decode the BASE64-JSON-encoded payload
      const decodedPayload = JSON.parse(atob(payload));
      
      // Validate algorithm
      const alg_ok = equals(decodedPayload.algorithm, 'SHA-256');
  
      // Validate challenge
      const challenge = decodedPayload.salt + decodedPayload.number;
      const computedChallenge = await sha256(challenge);
      const challenge_ok = equals(decodedPayload.challenge, computedChallenge);
  
      // Validate signature
      const computedSignature = await hmacSHA256(decodedPayload.challenge, hmac_key);
      const signature_ok = equals(decodedPayload.signature, computedSignature);
  
      // Consider the request verified if all checks are true
      const verified = alg_ok && challenge_ok && signature_ok;
      
      return verified;
    } catch (error) {
      console.error('Error occurred while validating payload:', error);
      return false; // Return false if an error occurs during validation
    }
  }
  
  // Example usage
  const payload = "eyJhbGdvcml0aG0iOiJITUFDLVNIQTI1NiIsImNoYWxsZW5nZSI6ImFzY2lpX2NoYWxsZW5nZV9zZWNyZXQiLCJzdWJqZWN0IjoiMTIzNDUiLCJzYWx0IjoiYXNkZiIsInNpZ25hdHVyZSI6IjEyMzQ1Njc4OTAifQ==";
  const hmac_key = "your_hmac_key_here";
  
  validatePayload(payload, hmac_key).then(verified => {
    if (verified) {
      console.log('Payload verified.');
    } else {
      console.log('Payload verification failed.');
    }
  });
  