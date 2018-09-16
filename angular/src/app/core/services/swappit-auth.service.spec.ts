import { TestBed, inject } from '@angular/core/testing';

import { SwappitAuthService } from './swappit-auth.service';

describe('SwappitAuthService', () => {
  beforeEach(() => {
    TestBed.configureTestingModule({
      providers: [SwappitAuthService]
    });
  });

  it('should be created', inject([SwappitAuthService], (service: SwappitAuthService) => {
    expect(service).toBeTruthy();
  }));
});
