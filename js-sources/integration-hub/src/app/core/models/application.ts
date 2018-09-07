import {Model} from "../interfaces/models/model";

/**
 * Application model
 */
export class Application implements Model {
    public id: string;

    public name: string;

    public client_id: string;

    public client_secret: string;
}