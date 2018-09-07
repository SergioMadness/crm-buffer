import {Injectable} from '@angular/core';
import {HttpClient} from "@angular/common/http";
import {Observable} from "rxjs/index";
import {HelpersService} from "@app/core/services/helpers.service";
import {AuthService} from "@app/core/interfaces/services/auth-service";
import {User} from "@app/core/models/user";
import {IUser} from "@app/core/interfaces/models/user";

const URL_LOGIN = '/api/v1/login';

@Injectable({
    providedIn: 'root'
})
/**
 * Service to authorize users
 */
export class AuthorizationService implements AuthService {

    constructor(private http: HttpClient) {
    }

    /**
     * Log in
     * @param {string} login
     * @param {string} password
     * @returns {Observable<object>}
     */
    public login(login: string, password: string): Observable<IUser> {
        return this.http.post<User>(HelpersService.prepareUrl(URL_LOGIN), {
            login: login,
            password: password
        });
    }
}
