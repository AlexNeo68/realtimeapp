import Token from './Token';
import AppStorage from './AppStorage';
class User {
    async login(data) {
        try {
            const res = await axios.post('api/auth/login', data);
            this.responseAfterLogin(res);
        } catch (error) {
            console.log(error.response);
        }
    }

    responseAfterLogin(res) {
        const { user, access_token } = res.data;
        if (Token.isValid(access_token)) {
            AppStorage.store(access_token, user);
        }
    }

    hasToken() {
        const storedToken = AppStorage.getToken();
        if (storedToken) {
            return Token.isValid(storedToken) ? true : false;
        }
        return false;
    }

    isLoggedIn() {
        return this.hasToken();
    }

    logout() {
        AppStorage.clear();
    }

    name() {
        if (this.isLoggedIn()) return AppStorage.getUser();
        return false;
    }

    id() {
        const payload = Token.payload(AppStorage.getToken());
        if (payload) return payload.sub;
        return false;
    }
}

export default User = new User();
