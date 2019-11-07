class Token {
    isValid(token) {
        const payload = this.payload(token);
        return payload.iss == 'http://127.0.0.1:8000/api/auth/login'
            ? true
            : false;
    }

    payload(token) {
        const payload = token.split('.')[1];
        if (payload) return this.decode(payload);
        return false;
    }

    decode(data) {
        return JSON.parse(atob(data));
    }
}
export default Token = new Token();
