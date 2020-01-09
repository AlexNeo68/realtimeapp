import User from './User';

class Exception {
    error(error){
        this.handle(error.response.data.error)
    }

    handle(message){
        if (message == 'The token is expired') User.logout();
    }
}

export default Exception = new Exception();
