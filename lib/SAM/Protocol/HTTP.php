<?php
namespace SAM\Protocol;

class HTTP {

    public static function getlabel ($code) {

        switch ($code) {

            // 1xx: INFORMATIONAL - Request received, continuing process
            case 100: return 'Continue';                            // https://wwww.iana.org/rfc7231 ¶ 6.2.1
            case 101: return 'Switching protocols';                 // https://wwww.iana.org/rfc7231 ¶ 6.2.2
            case 102: return 'Processing';                          // https://wwww.iana.org/rfc2518
            case 103: return 'Early hints';                         // https://wwww.iana.org/rfc8297
            // 104-199                                              // unassigned

            // 2xx: SUCCESS - The action was successfully received, understood, and accepted
            case 200: return 'OK';                                  // https://wwww.iana.org/rfc7231 ¶ 6.3.1
            case 201: return 'Created';                             // https://wwww.iana.org/rfc7231 ¶ 6.3.2
            case 202: return 'Accepted';                            // https://wwww.iana.org/rfc7231 ¶ 6.3.3
            case 203: return 'Non-authoritative information';       // https://wwww.iana.org/rfc7231 ¶ 6.3.4
            case 204: return 'No content';                          // https://wwww.iana.org/rfc7231 ¶ 6.3.5
            case 205: return 'Reset content';                       // https://wwww.iana.org/rfc7231 ¶ 6.3.6
            case 206: return 'Partial content';                     // https://wwww.iana.org/rfc7233 ¶ 4.1
            case 207: return 'Multi-status';                        // https://wwww.iana.org/rfc4918
            case 208: return 'Already reported';                    // https://wwww.iana.org/rfc5842
            // 209-225                                              // unassigned
            case 226: return 'IM used';                             // https://wwww.iana.org/rfc3229
            // 227-299                                              // unassigned

            // 3xx: REDIRECTION - Further action must be taken in order to complete the request
            case 300: return 'Multiple choices';                    // https://wwww.iana.org/rfc7231 ¶ 6.4.1
            case 301: return 'Moved permanently';                   // https://wwww.iana.org/rfc7231 ¶ 6.4.2
            case 302: return 'Found';                               // https://wwww.iana.org/rfc7231 ¶ 6.4.3
            case 303: return 'See other';                           // https://wwww.iana.org/rfc7231 ¶ 6.4.4
            case 304: return 'Not modified';                        // https://wwww.iana.org/rfc7232 ¶ 4.1
            case 305: return 'Use proxy';                           // https://wwww.iana.org/rfc7231 ¶ 6.4.5
            case 306: return '(Unused)';                            // https://wwww.iana.org/rfc7231 ¶ 6.4.6
            case 307: return 'Temporary redirect';                  // https://wwww.iana.org/rfc7231 ¶ 6.4.7
            case 308: return 'Permanent redirect';                  // https://wwww.iana.org/rfc7538
            // 309-399                                              // unassigned

            // 4xx: CLIENT ERROR - The request contains bad syntax or cannot be fulfilled
            case 400: return 'Bad request';                         // https://wwww.iana.org/rfc7231 ¶ 6.5.1
            case 401: return 'Unauthorized';                        // https://wwww.iana.org/rfc7235 ¶ 3.1
            case 402: return 'Payment required';                    // https://wwww.iana.org/rfc7231 ¶ 6.5.2
            case 403: return 'Forbidden';                           // https://wwww.iana.org/rfc7231 ¶ 6.5.3
            case 404: return 'Not found';                           // https://wwww.iana.org/rfc7231 ¶ 6.5.4
            case 405: return 'Method not allowed';                  // https://wwww.iana.org/rfc7231 ¶ 6.5.5
            case 406: return 'Not acceptable';                      // https://wwww.iana.org/rfc7231 ¶ 6.5.6
            case 407: return 'Proxy authentication required';       // https://wwww.iana.org/rfc7235 ¶ 3.2
            case 408: return 'Request timeout';                     // https://wwww.iana.org/rfc7231 ¶ 6.5.7
            case 409: return 'Conflict';                            // https://wwww.iana.org/rfc7231 ¶ 6.5.8
            case 410: return 'Gone';                                // https://wwww.iana.org/rfc7231 ¶ 6.5.9
            case 411: return 'Length required';                     // https://wwww.iana.org/rfc7231 ¶ 6.5.10
            case 412: return 'Precondition failed';                 // https://wwww.iana.org/rfc7232 ¶ 4.2
            //                                                      // https://wwww.iana.org/rfc8144 ¶ 3.2
            case 413: return 'Payload too large';                   // https://wwww.iana.org/rfc7231 ¶ 6.5.11
            case 414: return 'URI too long';                        // https://wwww.iana.org/rfc7231 ¶ 6.5.12
            case 415: return 'Unsupported media type';              // https://wwww.iana.org/rfc7231 ¶ 6.5.13
            //                                                      // https://wwww.iana.org/rfc7694 ¶ 3
            case 416: return 'Range not satisfiable';               // https://wwww.iana.org/rfc7233 ¶ 4.4
            case 417: return 'Expectation failed';                  // https://wwww.iana.org/rfc7231 ¶ 6.5.14
            // 418-420                                              // unassigned
            case 421: return 'Misdirected request';                 // https://wwww.iana.org/rfc7540 ¶ 9.1.2
            case 422: return 'Unprocessable entity';                // https://wwww.iana.org/rfc4918
            case 423: return 'Locked';                              // https://wwww.iana.org/rfc4918
            case 424: return 'Failed dependency';                   // https://wwww.iana.org/rfc4918
            case 425: return 'Too early';                           // https://wwww.iana.org/rfc8470
            case 426: return 'Upgrade required';                    // https://wwww.iana.org/rfc7231 ¶ 6.5.15
            // 427                                                  // unassigned
            case 428: return 'Precondition required';               // https://wwww.iana.org/rfc6585
            case 429: return 'Too many requests';                   // https://wwww.iana.org/rfc6585
            // 430                                                  // unassigned
            case 431: return 'Request header fields too large';     // https://wwww.iana.org/rfc6585
            // 432-450                                              // unassigned
            case 451: return 'Unavailable for legal reasons';       // https://wwww.iana.org/rfc7725
            // 452-499                                              // unassigned

            // 5xx: SERVER ERROR - The server failed to fulfill an apparently valid request
            case 500: return 'Internal server error';               // https://wwww.iana.org/rfc7231 ¶ 6.6.1
            case 501: return 'Not implemented';                     // https://wwww.iana.org/rfc7231 ¶ 6.6.2
            case 502: return 'Bad gateway';                         // https://wwww.iana.org/rfc7231 ¶ 6.6.3
            case 503: return 'Service unavailable';                 // https://wwww.iana.org/rfc7231 ¶ 6.6.4
            case 504: return 'Gateway timeout';                     // https://wwww.iana.org/rfc7231 ¶ 6.6.5
            case 505: return 'HTTP version not supported';          // https://wwww.iana.org/rfc7231 ¶ 6.6.6
            case 506: return 'Variant also negotiates';             // https://wwww.iana.org/rfc2295
            case 507: return 'Insufficient storage';                // https://wwww.iana.org/rfc4918
            case 508: return 'Loop detected';                       // https://wwww.iana.org/rfc5842
            // 509                                                  // unassigned
            case 510: return 'Not extended';                        // https://wwww.iana.org/rfc2774
            case 511: return 'Network authentication required';     // https://wwww.iana.org/rfc6585
            // 512-549                                              // unassigned
            case 550: return 'SQL statement preparation failed';    // SAMinfo specific
            // 512-599                                              // unassigned

            default: return "Houston we've had a problem!";         // this should never be returned!
        }
    }

    public static function getprefix () {
        // TODO What about protocol versions 2 and 3
        return 'HTTP/1.1';
    }

}

// __END__
