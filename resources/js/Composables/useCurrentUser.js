import User from "@/Models/User.js";
import {toRaw} from "vue";
import {usePage} from "@inertiajs/vue3";

export function useCurrentUser() {
    return new User(toRaw(toRaw(usePage()).props.value.auth.user))
}
