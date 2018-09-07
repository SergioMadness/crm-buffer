import {Observable} from "rxjs/index";
import {IUser} from "../models/user";

/**
 * Interface for authorizations service
 */
export interface AuthService {
    login(login: string, password: string): Observable<IUser>;
}