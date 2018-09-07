import {IUser} from "@app/core/interfaces/models/user";

export class User implements IUser {
    public id: string;

    public login: string;
}