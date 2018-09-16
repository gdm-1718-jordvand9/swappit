import { Injectable } from '@angular/core';
import { PaginationLinks } from '../models/pagination-links';
import { PaginationMeta } from '../models/pagination-meta';

@Injectable()
export class PaginationService {

  pagination_links: PaginationLinks;
  pagination_meta: PaginationMeta;
  pagination_index: number = 10;
  pagination_start_page: number;
  pagination_end_page: number;
  pagination_page_numbers: Array<number> = [];

  constructor() { 
  }

  getPagination(links: PaginationLinks, meta: PaginationMeta) {
    this.pagination_page_numbers = [];
    console.log(links);
    console.log(meta);
    // Assign paramters to pagination classes
    this.pagination_links = links;
    this.pagination_meta = meta;

    // Check if amount of pages is smaller than page index.
    if (this.pagination_meta.last_page <= this.pagination_index) {
      this.pagination_start_page = 1;
      this.pagination_end_page = this.pagination_meta.last_page;
    }
    else {
      if (this.pagination_meta.current_page <= 6) {
        this.pagination_start_page = 1;
        this.pagination_end_page = this.pagination_index;
      }
      else if (this.pagination_meta.current_page + 4 >= this.pagination_meta.last_page) {
        this.pagination_start_page = this.pagination_meta.current_page - 9;
        this.pagination_end_page = this.pagination_meta.last_page;
      }
      else {
        this.pagination_start_page = this.pagination_meta.current_page - 5;
        this.pagination_end_page = this.pagination_meta.current_page + 4;
      }
    }
    for (let i = this.pagination_start_page; i <= this.pagination_end_page; i++) {
      this.pagination_page_numbers.push(i);
    }
    return {
      links:
        {
          prev: this.pagination_links.prev,
          next: this.pagination_links.next,
          first: this.pagination_links.first,
          last: this.pagination_links.last,
          path: this.pagination_links.path,
          current_page: this.pagination_meta.current_page,
          paramater_page: '?page='
        },
      meta: this.pagination_page_numbers
    };
  }

}
