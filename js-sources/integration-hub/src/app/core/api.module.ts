import {NgModule} from '@angular/core';
import {ApplicationsService} from "./api/applications.service";
import {HttpClientModule} from "@angular/common/http";
import {AuthorizationService} from "@app/core/api/authorization.service";
import {IApplicationsService} from "@app/core/interfaces/services/application-service";
import {AuthService} from "@app/core/interfaces/services/auth-service";

@NgModule({
    imports: [
        HttpClientModule
    ],
    declarations: [],
    providers: [
        ApplicationsService,
        AuthorizationService,
    ]
})
export class ApiModule {

    constructor(
        private applicationService: ApplicationsService,
        private authService: AuthorizationService
    ) {
    }

    /**
     * Create service to work with applications
     * @returns {ApplicationsService}
     */
    applications(): IApplicationsService {
        return this.applicationService;
    }

    /**
     * Create authorization service
     * @returns {AuthService}
     */
    authorization(): AuthService {
        return this.authService;
    }
}
