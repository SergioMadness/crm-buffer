import {Model} from "../models/model";

export interface ListService {
    /**
     * Get items list
     * @param {Array<object>} filter
     * @param {Array<object>} sort
     * @param {number} limit
     * @param {number} offset
     */
    list(filter?: object, sort?: object, limit?: number, offset?: number);

    /**
     * Get item by id
     * @param {string} id
     */
    get(id: string);

    /**
     * Save model
     * @param {object} model
     */
    save(model: Model);

    /**
     * Remove model
     * @param {number} id
     */
    remove(id: number);
}
