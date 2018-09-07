import { ModelsModule } from './models.module';

describe('ModelsModule', () => {
  let modelsModule: ModelsModule;

  beforeEach(() => {
    modelsModule = new ModelsModule();
  });

  it('should create an instance', () => {
    expect(modelsModule).toBeTruthy();
  });
});
