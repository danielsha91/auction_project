#!/usr/bin/python -tt
import sys

sep = '<>'

def main(argv):
    dictBidder = dictUser('AuctionBidder.dat')
    dictSeller = dictUser('AuctionSeller.dat')

    setBidderId = set(dictBidder.keys())
    setSellerId = set(dictSeller.keys())
    setBothId = setBidderId.intersection(setSellerId)

    result = {}

    for k in dictBidder.keys():
        result[k] = [0, 1, dictBidder[k]]
    for k in dictSeller.keys():
        result[k] = [1, 0, dictSeller[k]]

    for k in setBothId:
        result[k] = [1, 1, result[k][-1]]

    for k in result.keys():
        print '%s%s%d%s%d%s%s' %(k, sep, result[k][0], sep, result[k][1], sep, result[k][-1])

def dictUser(loadFileName):
    dictUser = {}
    for line in open(loadFileName):
        segs = line.strip().split(sep)
        dictUser[segs[0]] = sep.join(segs[1:])
    return dictUser


if __name__ == '__main__':
    main(sys.argv)
