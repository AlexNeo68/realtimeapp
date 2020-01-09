class Token {
    isValid(token) {
        const payload = this.payload(token);
        return payload.iss == "http://realtimeapp.loc/api/auth/login" ||
            payload.iss == "http://realtimeapp.loc/api/auth/signup"
            ? true
            : false;
    }

    payload(token) {
        const payload = token.split(".")[1];
        if (payload){
            if (this.isBase64(payload)){
                return this.decode(payload);
            }
        }
        return false;
    }

    isBase64(str){
        try {
            return btoa(atob(str)).replace(/=/g,'') == str;
        }catch (e) {
            return false;
        }

    }

    decode(data) {
        return JSON.parse(atob(data));
    }
}
export default Token = new Token();
