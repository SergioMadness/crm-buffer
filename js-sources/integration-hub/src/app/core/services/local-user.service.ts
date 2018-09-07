import {Injectable} from '@angular/core';
import {LocalUser} from "@app/core/interfaces/services/local-user";
import {CookieService} from "ngx-cookie-service";

@Injectable({
    providedIn: 'root'
})
export class LocalUserService implements LocalUser {

    constructor(private cookieService: CookieService) {
    }

    getToken(): string {
        return this.cookieService.get('token');
    }

    isAuthorized(): boolean {
        return this.getToken() !== '';
    }

    logout(): LocalUser {
        this.cookieService.delete("token");
        this.cookieService.delete("refresh-token");

        return this;
    }

    setTokens(token: string, refreshToken: string): LocalUser {
        this.cookieService.set("token", token);
        this.cookieService.set("refresh-token", refreshToken);

        return this;
    }
}
