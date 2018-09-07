import {CommonFeaturesModule} from './common.module';

describe('CommonFeaturesModule', () => {
    let commonModule: CommonFeaturesModule;

    beforeEach(() => {
        commonModule = new CommonFeaturesModule();
    });

    it('should create an instance', () => {
        expect(commonModule).toBeTruthy();
    });
});
