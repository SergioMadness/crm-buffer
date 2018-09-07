import {ListService} from "@app/core/interfaces/services/list-service";

/**
 * Interface for application service
 */
export interface IApplicationsService extends ListService {
    /**
     * Method to regenerate application keys
     */
    regenerateKeys(id: string);
}