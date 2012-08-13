biologger
=========
Author: Ed Hunsinger

Biologger is intended to be a simple to use life logging tool for quantified
self sort of tracking. It's being designed primarily for my own use, but may
be useful for others.

My goals:
* Should be easy and quick to use on an iPhone.
* User interface is bare bones for data input.
* Does not provide any analysis of data, merely records it.
* Logs to text files that are consumable by Splunk Storm.

This does use iWebKit, which should be placed in /iwebkit (or appropriate files
should be updated with the correct path).
iWebKit is available here: http://snippetspace.com/portfolio/iwebkit/

Please note: Security is not implemented in this on purpose for ease of use.
Security is up to the user if this is used on a publicly available server