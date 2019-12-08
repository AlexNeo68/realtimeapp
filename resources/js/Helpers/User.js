import Token from "./Token";
import AppStorage from "./AppStorage";
class User {
    async login(data, router) {
        try {
            const res = await axios.post("api/auth/login", data);
            this.responseAfterLogin(res);
            router.push({ name: "forum" });
            return true;
        } catch (error) {
            console.log(error.response);
            return error.response;
        }
    }

    async signup(data, router) {
        try {
            const res = await axios.post("api/auth/signup", data);
            this.responseAfterLogin(res);
            router.push({ name: "forum" });
            return true;
        } catch (error) {
            console.log(error.response);
            return error.response.data.errors;
        }
    }

    responseAfterLogin(res) {
        const { user, access_token } = res.data;
        if (Token.isValid(access_token)) {
            AppStorage.store(access_token, user);
            window.location = "/forum";
        } else {
            console.log("Token is not validation");
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
        window.location = "/forum";
    }

    name() {
        if (this.isLoggedIn()) return AppStorage.getUser();
        return false;
    }

    id() {
        if (this.isLoggedIn()) {
            const payload = Token.payload(AppStorage.getToken());
            if (payload) return payload.sub;
            return false;
        }
        return false;
    }

    own(id) {
        return this.id() == id;
    }
}

export default User = new User();
