import {Injectable} from '@angular/core';
import {HttpClient, HttpParams} from "@angular/common/http";
import {Observable} from "rxjs/index";
import {Model} from "../interfaces/models/model";
import {HelpersService} from "../services/helpers.service";
import {Application} from "../models/application";
import {ApiModule} from "../api.module";
import {IApplicationsService} from "@app/core/interfaces/services/application-service";

/**
 * Url to get application list
 * @type {string}
 */
const URL_APPLICATION_LIST = '/api/v1/applications';

/**
 * Url to get single application
 * @type {string}
 */
const URL_APPLICATION_GET = '/api/v1/applications/:id';

/**
 * Url to add application
 * @type {string}
 */
const URL_APPLICATION_ADD = '/api/v1/applications';

/**
 * Utl to update application
 * @type {string}
 */
const URL_APPLICATION_SAVE = '/api/v1/applications/:id';

/**
 * Url to remove application
 * @type {string}
 */
const URL_APPLICATION_REMOVE = '/api/v1/applications/:id';

/**
 * Url to regenrate application keys
 * @type {string}
 */
const URL_APPLICATION_REGENERATE_KEYS = '/api/v1/applications/:id/regenerate-keys';

@Injectable({
    providedIn: ApiModule,
})
/**
 * Service to work with applications
 */
export class ApplicationsService implements IApplicationsService {

    constructor(private http: HttpClient) {
    }

    /**
     * Get single application by ID
     * @param {string} id
     * @returns {Observable<Application>}
     */
    get(id: string): Observable<Application> {
        return this.http.get<Application>(HelpersService.prepareUrl(URL_APPLICATION_GET, {id: id}));
    }

    /**
     * Get application list
     * @param {object} filter
     * @param {object} sort
     * @param {number} limit
     * @param {number} offset
     * @returns {Observable<Application[]>}
     */
    list(filter?: object, sort?: object, limit?: number, offset?: number): Observable<Application[]> {
        return this.http.get<Application[]>(HelpersService.prepareUrl(URL_APPLICATION_LIST), {
            params: new HttpParams({
                fromString: HelpersService.prepareParams({
                    filter: filter,
                    sort: sort,
                    limit: limit,
                    offset: offset
                })
            })
        });
    }

    /**
     * Remove application by ID
     * @param {number} id
     * @returns {Observable<object>}
     */
    remove(id: number): Observable<object> {
        return this.http.delete(HelpersService.prepareUrl(URL_APPLICATION_REMOVE, {
            id: id
        }));
    }

    /**
     * Save model
     * @param {Model} model
     * @returns {Observable<Application>}
     */
    save(model: Model): Observable<Application> {
        if (model.id) {
            return this.http.post<Application>(HelpersService.prepareUrl(URL_APPLICATION_SAVE, {
                id: model.id
            }), model);
        }
        return this.http.post<Application>(URL_APPLICATION_ADD, model);
    }

    /**
     * Regenerate keys
     * @param {string} id
     * @returns {Observable<Application>}
     */
    regenerateKeys(id: string): Observable<Application> {
        return this.http.post<Application>(HelpersService.prepareUrl(URL_APPLICATION_REGENERATE_KEYS, {id: id}), {});
    }
}
