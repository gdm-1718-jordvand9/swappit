import { TestBed, inject } from '@angular/core/testing';

import { SwappitService } from './swappit.service';

describe('SwappitService', () => {
  beforeEach(() => {
    TestBed.configureTestingModule({
      providers: [SwappitService]
    });
  });

  it('should be created', inject([SwappitService], (service: SwappitService) => {
    expect(service).toBeTruthy();
  }));
});
