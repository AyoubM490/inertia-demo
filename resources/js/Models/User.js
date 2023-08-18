export default class User {
    constructor(attributes = {}) {
        Object.assign(this, attributes);
    }

    follows(user) {
        return true
    }

    is(user) {
        return this.id === user.id;
    }

    hasPrivateProfile() {

    }

    isALifer() {
        return false;
    }
}
