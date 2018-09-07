import { TestBed, inject } from '@angular/core/testing';

import { StringHelpersService } from './string-helpers.service';

describe('StringHelpersService', () => {
  beforeEach(() => {
    TestBed.configureTestingModule({
      providers: [StringHelpersService]
    });
  });

  it('should be created', inject([StringHelpersService], (service: StringHelpersService) => {
    expect(service).toBeTruthy();
  }));
});
